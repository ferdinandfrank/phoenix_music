<?php

namespace App\Console\Commands;

use App\Console\ConsoleLogger;
use App\Models\Settings;
use App\Models\User;
use Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

/**
 * Install
 * -----------------------
 * Console command to install the portfolio with all the mandatory information and settings.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Console\Commands
 */
class Install extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and configure the portfolio.';

    /**
     * The logger to print information on the console.
     *
     * @var ConsoleLogger
     */
    private $logger;

    /**
     * Executes the console command.
     */
    public function handle() {
        $this->logger = new ConsoleLogger($this, $this->output);

        $this->logger->comment('Welcome to the portfolio installation! You\'ll be up and running in no time...');

        if ($this->confirm('Do you wish to install the portfolio? If it was already installed, all of your database tables will be reset.')) {
            $this->setupDatabase();

            $this->setupPortfolioInformation();

            $this->setupSearchIndex();

            $this->setupApplicationKey();

            $this->setupAdditionalSettings();

            $this->seedDatabase();

            $this->finishSetup();
        }
    }

    /**
     * Migrates the database tables.
     */
    private function setupDatabase() {
        $this->logger->comment('Creating the database tables...');

        Artisan::call('migrate:refresh');

        $this->logger->progress(7);
        $this->logger->success('Your database tables are set up and configured.');
    }

    /**
     * Setups the portfolio with all the mandatory information.
     */
    private function setupPortfolioInformation() {
        $this->comment(PHP_EOL . 'Please provide the following information. Don\'t worry, you can always change these settings later.');

        // Super Admin User
        $this->comment(PHP_EOL . 'Step 1/3: Creating the admin user');
        $this->setupAdmin();

        // Portfolio Title
        $portfolioTitle = $this->ask('Step 2/3: Title of your portfolio');
        $this->savePortfolioInfo('title', $portfolioTitle);

        // Portfolio Contact email address
        $portfolioEmail = $this->ask('Step 3/3: The contact email address to use for the contact form', false);
        $this->savePortfolioInfo('email_contact', $portfolioEmail);
        $this->savePortfolioInfo('email_admin', $portfolioEmail);
    }

    /**
     * Saves the specified setting value for the portfolio under the specified setting name.
     *
     * @param $settingName
     * @param $settingValue
     */
    private function savePortfolioInfo($settingName, $settingValue) {
        $this->saveSetting($settingName, $settingValue, "$settingName of the portfolio");
    }

    /**
     * Saves the specified setting value under the specified setting name.
     *
     * @param        $settingName
     * @param        $settingValue
     * @param string $consoleName
     */
    private function saveSetting($settingName, $settingValue, $consoleName = 'setting') {
        $this->comment("Saving $settingName ...");
        $settings = new Settings();

        if (empty($settingValue)) {
            $settingValue = null;
        }

        $settings->key = $settingName;
        $settings->value = $settingValue;
        $settings->save();
        $this->logger->progress(1);
        $closingText = ".";
        if (!empty($settingValue)) {
            $closingText = " to '$settingValue'.";
        }
        $this->logger->success("The $consoleName has been saved$closingText");
    }

    private function setupAdmin() {
        $emailRules = ['email' => 'unique:users,email'];
        do {
            $email = $this->ask('Email address for the user');
            $validator = Validator::make(['email' => $email], $emailRules);
            if ($invalidEmail = $validator->fails()) {
                $this->error('That email already exists in the system.');
            }
        } while ($invalidEmail);

        $passwordRules = ['password' => 'confirmed'];
        do {
            $password = $this->secret('Password for the user');
            $passwordConfirmation = $this->secret('Confirm the password for the user');
            $validator = Validator::make(['password' => $password, 'password_confirmation' => $passwordConfirmation],
                $passwordRules);
            if ($invalidPassword = $validator->fails()) {
                $this->error('The passwords do not match.');
            }
        } while ($invalidPassword);

        $name = $this->ask('Name for the user');
        $user = $this->createUser($email, $password, $name, \Config::get('user_type.admin'));
        $this->logger->success('User has been created.');
        $this->savePortfolioInfo('author', $user->name);
    }

    private function createUser($email, $password, $name, $userType = 0) {
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->name = $name;
        $user->user_type = $userType;
        $user->save();

        $this->logger->comment('Saving user information...');
        $this->logger->progress(1);

        return $user;
    }

    private function seedDatabase() {
        $this->logger->comment('Seeding the database...');
        Artisan::call('db:seed');
        $this->logger->progress(3);
        $this->logger->success('The database has been filled with mandatory data.');
    }

    private function setupSearchIndex() {
        $this->logger->comment('Building the search index...');
        Artisan::call('portfolio:index');
        $this->logger->progress(2);
        $this->logger->success('The application search index has been built.');
    }

    private function setupApplicationKey() {
        $this->logger->comment('Creating a unique application key...');
        Artisan::call('key:generate');
        $this->logger->progress(5);
        $this->logger->success('A unique application key has been generated.');
    }

    private function setupAdditionalSettings() {
        $this->savePortfolioInfo('description', null);
        $this->savePortfolioInfo('keywords', null);
        $this->savePortfolioInfo('logo', null);
        $this->savePortfolioInfo('background', null);
        $this->savePortfolioInfo('favicon', null);
        $this->savePortfolioInfo('imprint', null);
        $this->savePortfolioInfo('intro_video', null);
        $this->savePortfolioInfo('text_stye', null);
        $this->savePortfolioInfo('text_audiojungle', null);
        $this->savePortfolioInfo('youtube', null);
        $this->savePortfolioInfo('twitter', null);
        $this->savePortfolioInfo('facebook', null);
        $this->savePortfolioInfo('stye', null);
        $this->savePortfolioInfo('audiojungle', null);
        $this->savePortfolioInfo('cdbaby', null);
        $this->savePortfolioInfo('iTunes', null);
        $this->savePortfolioInfo('amazon', null);
    }

    private function finishSetup() {
        $this->logger->success('The portfolio has been installed. Pretty easy huh?' . PHP_EOL);

        $headers = ['Login Email', 'Login Password'];
        $data = User::select('email', 'password')->get()->toArray();
        $data[0]['password'] = 'Your chosen password.';
        $this->logger->table($headers, $data);
    }

}

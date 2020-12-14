<?php 

/**
 * @author Studio Zerotredici
*/

namespace App\Commands;


use App\Actions\CreateProjectAction;
use App\Configuration\Config;
use App\Input\Interrogator;
use App\Support\Traits\HasCommandExecutor;
use App\Support\Traits\HasCommandOptions;
use App\Support\Traits\RequireEnvFile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProject extends Command
{
    use RequireEnvFile;
    use HasCommandOptions;
	use HasCommandExecutor;
	
	private $questionHelper;
    private $inputInterface;
    private $outputInterface;

    private $config;

    private $projectDirectory;
    private $composerProject;
    private $projectName;

    private $interrogator;

	private $commandExecutor;

	public function __construct($name = null, Config $config)
    {
        $this->config = $config;
        parent::__construct($name);
	}

	protected function configure()
    {
        $this
            ->setName('blank:create-project')
            ->setDescription('Create a new blank project')
            ->setHelp("");
    }
	
    private function init(InputInterface $input, OutputInterface $output){
        $this->inputInterface = $input;
        $this->outputInterface = $output;
        $this->hasDotEnvFile();
        $this->questionHelper = $this->getHelper('question');
        $this->interrogator = new Interrogator($input, $output, $this->getHelper('question'));
    }

	protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->init($input, $output);

        $taskConfirmation = $this->getTaskConfirmationFromQuestion();

        if($taskConfirmation){
            $this->runTasks();
        }else{
            $output->writeln('<error>Tasks cancelled</error>');
        }

        return;

	}

	private function createProjectAction(){
		if(!empty($this->config->getAccessLocalSitesDirectoryCommand())){
            $accessCommand = $this->config->getAccessLocalSitesDirectoryCommand();
        }else{
			if(!is_dir($this->projectDirectory)) {
				switch($this->config->getCurrentOs()) {
					case 'Windows':
						$create_command = 'mkdir '.$this->projectDirectory.' && ';
					break;
					case 'Linux':
						$create_command = 'mkdir '.$this->projectDirectory.' && ';
					break;
					case 'Os':
						$create_command = 'mkdir '.$this->projectDirectory.' && ';
					break;
				}
				$accessCommand = $create_command.'cd '.$this->projectDirectory;
			} else {
				$accessCommand = 'cd '.$this->projectDirectory;
			}
        }
        return new CreateProjectAction($this->getCommandExecutor(),$accessCommand, $this->composerProject, $this->projectName);
	}
	
	private function getTaskConfirmationFromQuestion(){
        $this->outputInterface->writeln('<info>The following tasks will be executed:</info>');

        $this->outputInterface->writeln('- '.$this->CreateProjectAction()->confirmationMessage());

        $response = $this->interrogator->ask(
            'Run tasks?',
            'Y'
        );
        if(strtoupper($response) == 'Y'){
            return true;
        }
        return false;
	}
	
	private function runTasks(){
        $this->outputInterface->writeln('<info>'.$this->CreateProjectAction()->actionMessage().'...</info>');
        $this->CreateProjectAction()->run();
        $this->outputInterface->writeln('');
        $this->outputInterface->writeln('<info>Complete!</info>');
    }

}


?>
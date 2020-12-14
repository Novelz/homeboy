<?php

/**
 * @author Studio Zerotredici
*/

namespace App\Actions;

use App\Actions\Interfaces\ActionInterface;


class CreateProjectAction extends BaseAction implements ActionInterface {

    private $commandExecutor;
    private $accessCommand;
    private $project;
    private $name;

    public function __construct($commandExecutor, $accessCommand, $project, $name)
    {
        $this->commandExecutor = $commandExecutor;
        $this->accessCommand = $accessCommand;
        $this->project = $project;
        $this->name = $name;
	}

    private function command(){
        return $this->accessCommand;
    }

    public function confirmationMessage(){
        return 'Run Command: '.$this->command();
    }

    public function actionMessage(){
        return 'Creating folder';
    }

    public function run(){
        $this->commandExecutor->run($this->command());
    }

}
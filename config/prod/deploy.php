<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultConfiguration;
use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

/** 
 *@see https://github.com/EasyCorp/easy-deploy-bundle/blob/master/doc/default-deployer.md 
*/
return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('emanagc@ftp.cluster023.hosting.ovh.net')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/home/emanagc')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:HOELTZENERwan/projet-Fil-Rouge-Greta.git')
            // the repository branch to deploy
            ->repositoryBranch('backoffice')
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        // $this->runLocal('./vendor/bin/simple-phpunit');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        // $this->runRemote('{{ console_bin }} app:my-task-name');
        // $this->runLocal('say "The deployment has finished."');
    }
};

# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # set box
  config.vm.box = 'bento/debian-8.6'

  # forward ports
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "forwarded_port", guest: 3306, host: 3306

  # set synced folder
  config.vm.synced_folder '.', '/var/www'

  # file to run at provision
  config.vm.provision :shell, :path => "VagrantBootstrap.sh"
end
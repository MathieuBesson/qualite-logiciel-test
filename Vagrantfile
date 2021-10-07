
Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/focal64"
  
  config.vm.provider "virtualbox" do |v|
        v.name = "test-qualite"
  end
  
  config.vm.synced_folder "./donnee/", "/var/www", owner: 'www-data', group: 'www-data', id: 'source', mount_options: ['dmode=777', 'fmode=777']
  
  config.vm.network "private_network", ip: "192.168.88.188"
  
  config.vm.provision :shell, path: "donnee/provision/components/apt.sh"
  config.vm.provision :shell, path: "donnee/provision/components/nginx.sh"
  config.vm.provision :shell, path: "donnee/provision/components/php.sh"
  config.vm.provision :shell, path: "donnee/provision/components/mariadb.sh"
  config.vm.provision :shell, path: "donnee/provision/components/composer.sh"
  config.vm.provision :shell, path: "donnee/provision/components/git.sh"
  config.vm.provision :shell, path: "donnee/provision/components/jenkins.sh"
  
  config.vm.provision :shell, inline: "echo 'cd /var/www' >> /home/vagrant/.profile"

end

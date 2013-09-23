Vagrant.configure("2") do |config|
  # Setup the box
  config.vm.box = "ubuntu12_64_quantal"
  config.vm.box_url = "https://github.com/downloads/roderik/VagrantQuantal64Box/quantal64.box"
  
  #config.vm.customize do |vm|
  #		vm.memory_size = 640
  #end
  config.vm.provider :virtualbox do |v|
    v.customize ["modifyvm", :id, "--cpuexecutioncap", "90"]
    v.customize ["modifyvm", :id, "--memory", 512]
  end

  #config.vm.forward_port 3306, 3333
  #config.vm.network :hostonly, "33.33.33.100"
  config.vm.network :private_network, ip: "33.33.33.101"
  
  #config.vm.share_folder("vagrant-root", "/vagrant", ".", :nfs => true)
  config.vm.synced_folder ".", "/vagrant", id: "vagrant-root", :nfs => true
  
  config.vm.provision :shell, :path => "provision.sh"
end
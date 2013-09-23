![dev.el logo](http://i.imgur.com/ACuqMZR.png)

Dev.el allows you to easily setup a [vagrant](http://www.vagrantup.com/) [virtual box](https://www.virtualbox.org/) virtual machine to ease the development of php applications.

Once run it will automatically provides you a complete running environment comprising:

* Ubuntu 12 (64bit quantal)
* PHP 5.4 (wit pear, dev, curl, mcrypt, intl, apc and gd)
* A suite of common php tools (composer, boris, phpunit)
* Mysql 5.5 (percona)
* phpMyAdmin
* Nginx

Setup
=====

Start by fetching the project in a directory of your choice through git:

     git clone git@github.com:lmammino/dev.el.git

Then you'll need to add the following 2 entries on your `hosts` file (`/etc/hosts` on mac and linux, `%SystemRoot%\system32\drivers\etc\hosts` on Windows):

	33.33.33.101	dev.el
	33.33.33.101 	phpmyadmin.dev.el

This way you will be able to access the webserver on your vm through the url [http://dev.el](http://dev.el).

Ok now you have a vagrant project on the hand, so if you already know ho to use vagrant you are just a `vagrant up` away to start. If you don't know vagrant keep reading the next paragraphs. 

Using Vagrant
=============

Download a 1.x version (v1.1.4 suggested) from the [official website](http://vagrantup.com/).

1. Requisites
-------------
  
  * Ruby 1.8+
  * [Oracle VirtualBox](http://www.virtualbox.org/) 4.2+ (4.2.10 suggested)

2. Install vagrant runtimes
------------------------
Visit vagrant [official website](http://vagrantup.com/) and download the latest version for youir OS.

3. Running the virtual machine
------------------------------
Once you've installed vagrant and dowloaded the files from this repository you should simply pick up your command line and run `vagrant up` (on the path where you cloned the repository) to run the virtual machine. Anyway before running `vagrant up` it would be good to enable the virtual box guest additions plugin with the command `vagrant plugin install vagrant-vbguest`.

4. Destroying the virtual machine
---------------------------------
Run `vagrant destroy` to shutdown the current running virtual machine and remove it from the disk.

5. Suspending/resuming the virtual machine
------------------------------------------
Building the virtual machine with `vagrant up` is a slow operation, it takes about from 2 to 15 minutes, depending on your cpu and ram. So it's highly suggested to not destroy it completely every time. It's better to suspend (`vagrant suspend`) and then resume it (`vagrant resume` or `vagrant up`).


6. Using the VM
---------------
The VM is preconfigured to create a local network between your PC and the VM instance. The VM will use the ip 33.33.33.101.
So, when the vm successfully started, you can go to `http://33.33.33.101` to run the application (or jus http://dev.el if you tweaked your hosts files).

You can also access to _phpMyAdmin_ using the url http://phpmyadmin.dev.el and user/pass **root/root** .

That's all, enjoy developing with dev.el ;)
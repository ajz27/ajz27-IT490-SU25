# install net tools
sudo apt install net-tools

# get repository files
wget https://github.com/MattToegel/IT490/archive/refs/heads/main.zip

# ssh commands
sudo apt install openssh-server
sudo systemctl status ssh
sudo ufw allow ssh

# php command
sudo apt install php

# composer
sudo apt install composer
composer update

# install rabbitmq
sudo apt install rabbitmq-server

# install zerotier
curl -s https://install.zerotier.com/ | sudo bash
# sudo zerotier-cli join (whatever the code is, can be joined through email from admin)

# run server sample
php RabbitMQServerSample.php

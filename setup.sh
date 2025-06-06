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

# run server sample
php RabbitMQServerSample.php
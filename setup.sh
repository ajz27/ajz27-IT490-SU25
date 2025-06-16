# install net tools
sudo apt install net-tools

# get repository files
git clone https://github.com/MattToegel/IT490/

# ssh commands
sudo apt install openssh-server
sudo systemctl status ssh
sudo ufw allow ssh
sudo systemctl start ssh

# php command
sudo apt install php -y

# edit json file
sed -i 's/Something-Fun/something-fun/' IT490/composer.json

# composer
sudo apt install composer -y
cd IT490/
composer update
cd ..

# install rabbitmq
sudo apt install rabbitmq-server -y

# install zerotier
curl -s https://install.zerotier.com/ | sudo bash
sudo zerotier-cli join 93afae596392e44c



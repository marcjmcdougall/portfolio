## My Portfolio

## Install chrome on the server

```
sudo apt update
sudo apt install -y wget unzip fontconfig fonts-liberation libu2f-udev libvulkan1
wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
sudo dpkg -i google-chrome-stable_current_amd64.deb
sudo apt -f install -y
rm google-chrome-stable_current_amd64.deb
```
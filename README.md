# Signid (SIGNID Kundenportal)
QR code management

How to configer the webiste into the server. Below are some simple point to follow to setup the webiste.

- Upload all the file into server under the PUBLIC HTML or WWW folder.
- Please create a Database for the webiste 
- Copy the webiste url (main url)  e.g https://www.google.com/
- Goto the application directory.
- Inside the application directory there is a folder called config folder go inside it.
- Inside the config folder please edit the file config.php
- Go to the line no 26
- In line no 26 ($config['base_url'] = '') put the webiste url (main url) inside the semicolon e.g ($config['base_url'] = 'https://www.google.com/')
- You will get a USERNAME AND PASSWORD AND THE DATABASE NAME after creting the Database
- Goto the application directory again.
- Inside the application directory there is a folder called config folder go inside it.
- Inside the config folder please edit the file database.php
- Edit the line 79/80/81
- 'username' => 'USERNAME',
  'password' => 'PASSWORD',
  'database' => 'DATABASE NAME',
- Update the both file and upload the file into the server and we are all done with the configuration.


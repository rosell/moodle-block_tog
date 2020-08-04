# Development notes

You must to install


## Start development environment

To start the development environment run the next script:

~~~sh
./startDevelopmentEnvironment.sh
~~~

It will start some services and open a **bash**. The services that will be started are:

 * Moodle at [http://localhost](http://localhost) with the credentials: user/bitnami
 * PHPMyAdmin [http://localhost:8081](http://localhost:8081) with the user **root** and empty password.
 * MailHog [http://localhost:8025/](http://localhost:8025/)
 
To compile an generate a moodle package run the next command:

~~~sh
./createPluginZipFile.sh
~~~

Add it store the result on the **dist** directory.


## Stop development environment

To close the development environment run the next script:

~~~sh
./stopDevelopmentEnvironment.sh
~~~


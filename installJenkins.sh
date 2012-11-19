#!/bin/sh
wget http://localhost:8080/jnlpJars/jenkins-cli.jar
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin phing
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin mercurial
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin checkstyle
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin pmd
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin dry
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin cloverphp
java -jar jenkins-cli.jar -s http://localhost:8080/ install-plugin htmlpublisher
java -jar jenkins-cli.jar -s http://localhost:8080/ safe-restart
java -jar jenkins-cli.jar -s http://localhost:8080/ create-job < jenkins.xml
rm jenkins-cli.jar

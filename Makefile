all:
	@echo "Available commands:"
	@grep "^[^#[:space:]].*:$$" Makefile | sort

startsolr:
	@cd fulltextsearch-localsolr/server/ && java -jar start.jar &

grunt:
	@cd app && grunt

setup:
	composer update
	cd app && npm install

fetch:
	GIT_SSH=gitproxy.sh git fetch origin

push:
	GIT_SSH=gitproxy.sh git push origin master
# Git Workflows

## Global `git` config
Generally, the global config files are located in the home directory `~/.gitconfig`. Open this file:
```
[user]
	name = {github name}
	email = {github email}
[core]
	autocrlf = input

```
Step 1:

    create `.gitignore` in the home directory, then add the files to be ignored globally.
```
.idea/
.DS_Store
.php_cs_cache
```
Step 2:

    apply this command to set the global ignore file

```
git config --global core.excludesfile '~/.gitignore'

```

> the other command to update the global setting

```
git config --global user.name 'your_name'
git config --global user.email 'your_email'

```

# WordPress Capistrano deployment

## basic setup stuff ##

# http://help.github.com/deploy-with-capistrano/
set :application, "SteveGrunwell.com"
set :repository, "git@github.com:stevegrunwell/stevegrunwell-com.git"
set :scm, "git"
default_run_options[:pty] = true

# use our keys, make sure we grab submodules, try to keep a remote cache
set :ssh_options, { :forward_agent => true }
set :deploy_via, :checkout
set :use_sudo, false
set :git_enable_submodules, false

set :branch, 'master'
set :branch, $1 if `git branch` =~ /\* (\S+)\s/m

## multi-stage deploy process ##

# `cap production deploy`
task :production do
  set :user, "steve"
  role :web, "stevegrunwell.com", :primary => true
  set :app_environment, "production"
  set :branch, "master"
  set :keep_releases, 5
  set :deploy_to, "/var/www/vhosts/stevegrunwell.com/httpdocs"
end

namespace :deploy do

  task :finalize_update, :except => { :no_release => true } do
    transaction do
      run "chmod -R g+w #{releases_path}/#{release_name}"
      run "ln -s #{shared_path}/uploads #{release_path}/wp-content/uploads"
      run "ln -s #{shared_path}/wp-config.php #{release_path}/wp-config.php"
      run "ln -s #{shared_path}/backups #{release_path}/wp-content/backups"

      # EWWW Image Optimizer
      run "ln -s #{shared_path}/ewww #{release_path}/wp-content/ewww"

      # Grunwell 2012 actions
      run "sass #{release_path}/wp-content/themes/grunwell2012/css/style.scss:#{release_path}/wp-content/themes/grunwell2012/css/style.css --style=compressed"
      run "sass #{release_path}/wp-content/themes/grunwell2012/css/ie8.scss:#{release_path}/wp-content/themes/grunwell2012/css/ie8.css --style=compressed"

      # WP Super Cache
      run "ln -s #{shared_path}/cache #{release_path}/wp-content/cache"
      run "ln -s #{shared_path}/wp-cache-config.php #{release_path}/wp-content/wp-cache-config.php"
    end
  end

  after "deploy", "deploy:cleanup"

end
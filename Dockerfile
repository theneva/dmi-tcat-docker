# Borrow good code. LAMP stack <3
FROM tutum/lamp:latest

# Add scripts for setting up the database on build. Automatically executed by /run.sh later
ADD mysql-setup.sh /
ADD setup-database.sql /

ENV tcat_git_repo https://github.com/digitalmethodsinitiative/dmi-tcat
ENV tcat_home /app

# Clone the newest dmi-tcat code to the app directory
RUN rm -rf /app
RUN git clone --depth 1 $tcat_git_repo $tcat_home
ADD index.html $tcat_home

# Set up output directories
RUN mkdir -p $tcat_home/analysis/cache && chmod 755 $tcat_home/analysis/cache
RUN mkdir -p $tcat_home/logs && chmod 755 $tcat_home/logs
RUN mkdir -p $tcat_home/proc && chmod 755 $tcat_home/proc

# Allow TCAT to use curl
RUN apt-get update
RUN apt-get install -y php5-curl

# Add the custom config file
ADD config.php $tcat_home

# Continuously ensure that the capture scripts are running
ADD capture-script-watcher.sh /
RUN chmod +x /capture-script-watcher.sh
ADD supervisord-capture-script-watcher.conf /etc/supervisor/conf.d/

# Configure Apache
ADD apache-passwords /
ADD apache.conf /etc/apache2/sites-available/000-default.conf

# Run the initialisation script from tutum/lamp:latest
CMD ["/run.sh"]

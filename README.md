# smartTelegramBot
telegram bot, that getting tweets from specific user, wrapping it with chatGPT API and pushing to telegram group


cron setup:
*/1 * * * * cd /var/www/twitter_bot && php send.php >/dev/null 2>&1
*/2 * * * * cd /var/www/twitter_bot && php tweetpicker.php -1001684819344 >/dev/null 2>&1


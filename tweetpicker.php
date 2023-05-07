<?php
function enqueue($item) {
    $queue_file = 'queue.txt';
    $queue_handle = fopen($queue_file, 'a');
    fwrite($queue_handle, $item . PHP_EOL);
    fclose($queue_handle);
}

$curl = curl_init();

$guestToken = 16551441261800000000000000;
$referer = 'https://twitter.com/XXXXX';

curl_setopt_array($curl, array(
    //tweets and replies
    CURLOPT_URL => 'https://twitter.com/i/api/graphql/qUf0dhgRdNjc04-PERceuA/UserTweetsAndReplies?variables=%7B%22userId%22%3A%222372768953%22%2C%22count%22%3A40%2C%22includePromotedContent%22%3Atrue%2C%22withCommunity%22%3Atrue%2C%22withVoice%22%3Atrue%2C%22withV2Timeline%22%3Atrue%7D&features=%7B%22rweb_lists_timeline_redesign_enabled%22%3Afalse%2C%22blue_business_profile_image_shape_enabled%22%3Atrue%2C%22responsive_web_graphql_exclude_directive_enabled%22%3Atrue%2C%22verified_phone_label_enabled%22%3Afalse%2C%22creator_subscriptions_tweet_preview_api_enabled%22%3Afalse%2C%22responsive_web_graphql_timeline_navigation_enabled%22%3Atrue%2C%22responsive_web_graphql_skip_user_profile_image_extensions_enabled%22%3Afalse%2C%22tweetypie_unmention_optimization_enabled%22%3Atrue%2C%22vibe_api_enabled%22%3Atrue%2C%22responsive_web_edit_tweet_api_enabled%22%3Atrue%2C%22graphql_is_translatable_rweb_tweet_is_translatable_enabled%22%3Atrue%2C%22view_counts_everywhere_api_enabled%22%3Atrue%2C%22longform_notetweets_consumption_enabled%22%3Atrue%2C%22tweet_awards_web_tipping_enabled%22%3Afalse%2C%22freedom_of_speech_not_reach_fetch_enabled%22%3Atrue%2C%22standardized_nudges_misinfo%22%3Atrue%2C%22tweet_with_visibility_results_prefer_gql_limited_actions_policy_enabled%22%3Afalse%2C%22interactive_text_enabled%22%3Atrue%2C%22responsive_web_text_conversations_enabled%22%3Afalse%2C%22longform_notetweets_rich_text_read_enabled%22%3Atrue%2C%22longform_notetweets_inline_media_enabled%22%3Afalse%2C%22responsive_web_enhance_cards_enabled%22%3Afalse%7D',
    // only tweets
//    CURLOPT_URL => 'https://twitter.com/i/api/graphql/nS8wT06hPXYE73bl6mitKQ/UserTweets?variables=%7B%22userId%22%3A%222372768953%22%2C%22count%22%3A40%2C%22includePromotedContent%22%3Atrue%2C%22withQuickPromoteEligibilityTweetFields%22%3Atrue%2C%22withVoice%22%3Atrue%2C%22withV2Timeline%22%3Atrue%7D&features=%7B%22rweb_lists_timeline_redesign_enabled%22%3Afalse%2C%22blue_business_profile_image_shape_enabled%22%3Atrue%2C%22responsive_web_graphql_exclude_directive_enabled%22%3Atrue%2C%22verified_phone_label_enabled%22%3Afalse%2C%22creator_subscriptions_tweet_preview_api_enabled%22%3Afalse%2C%22responsive_web_graphql_timeline_navigation_enabled%22%3Atrue%2C%22responsive_web_graphql_skip_user_profile_image_extensions_enabled%22%3Afalse%2C%22tweetypie_unmention_optimization_enabled%22%3Atrue%2C%22vibe_api_enabled%22%3Atrue%2C%22responsive_web_edit_tweet_api_enabled%22%3Atrue%2C%22graphql_is_translatable_rweb_tweet_is_translatable_enabled%22%3Atrue%2C%22view_counts_everywhere_api_enabled%22%3Atrue%2C%22longform_notetweets_consumption_enabled%22%3Atrue%2C%22tweet_awards_web_tipping_enabled%22%3Afalse%2C%22freedom_of_speech_not_reach_fetch_enabled%22%3Atrue%2C%22standardized_nudges_misinfo%22%3Atrue%2C%22tweet_with_visibility_results_prefer_gql_limited_actions_policy_enabled%22%3Afalse%2C%22interactive_text_enabled%22%3Atrue%2C%22responsive_web_text_conversations_enabled%22%3Afalse%2C%22longform_notetweets_rich_text_read_enabled%22%3Atrue%2C%22longform_notetweets_inline_media_enabled%22%3Afalse%2C%22responsive_web_enhance_cards_enabled%22%3Afalse%7D',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'authority: twitter.com',
        'accept: */*',
        'accept-language: ru',
        'authorization: Bearer AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA',
        'content-type: application/json',
        'cookie: _ga=GA1.2.1791045462.1683452062; _gid=GA1.2.1123887325.1683452062; guest_id=v1%3A168345206241347313; guest_id_ads=v1%3A168345206241347313; guest_id_marketing=v1%3A168345206241347313; gt=1655144126180999168; personalization_id="v1_0JRVI/N6cpqFvBr+KUSuYQ=="; ct0=7a629f398138a9da88e97ac63e4f88e9',
        'referer: ' . $referer,
        'sec-ch-ua: "Google Chrome";v="113", "Chromium";v="113", "Not-A.Brand";v="24"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Linux"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-origin',
        'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36',
        'x-guest-token: ' . $guestToken,
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$log_file = 'data.txt';


$obj = json_decode($response, true);
$instructions = $obj['data']['user']['result']['timeline_v2']['timeline']['instructions'];

foreach ($instructions as $instruction) {
    if ($instruction['type'] !== 'TimelineAddEntries') {
        continue;
    }

    foreach ($instruction['entries'] as $entry) {
        if (!isset($entry['content']['itemContent'])) {
            continue;
        }

        $entryID = $entry['entryId'];
        $content = $entry['content']['itemContent']['tweet_results']['result']['legacy']['full_text'];

        // skipping retweets
        if (strpos($content, 'RT @') !== false) {
            continue;
        }

        $timelineFile = 'timeline.txt';


        $found = false;
        $handle = fopen($timelineFile, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (strpos($line, $entryID) !== false) {
                    $found = true;
                    break;
                }
            }

            fclose($handle);
        }

        if (!$found) {
            file_put_contents($timelineFile, json_encode([
                    'entryId' => $entryID,
                    'text' => $content
                ]) . "\n", FILE_APPEND);

            enqueue(json_encode([
                'text' => $content,
                'chatID' => isset($argv[1]) ? $argv[1] : null
            ]));
        }
    }
}

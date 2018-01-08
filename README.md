# horo

This is the basic horoscope app code that is written for "Horscope Today Bot" Google Assistant and Astro Torch Facebook Messenger bot.

Currently, the App works using the dialogflow AI front where I have setup all the intents and related entities. The call from dialogflow processes through action.php, which is hosted on a https platform. This action.php calls my internal API file, which gives it the required data which is to be displayed on the bots.

Current version can talk to the user and get his sunsign and display the horoscope for today. This can also answer few petty questions which are funny, like "How old are you", "Who is your boss" using the Small Talk integration in Dialogflow.

If you are willing to participate, the next level of app will be :

Get, the user registration done at our end, so that we can send conversations in a more natural way. Examples ? Please mail me @ rathankalluri@gmail.com.

Create a complete PDF chart and send it later to the user. Can add monitization part if required (the APIs for this are costly, i cannot bear that and provide it for free).

And much more !!!

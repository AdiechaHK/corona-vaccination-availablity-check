# corona-vaccination-availablity-check
Just a simple script to continuesly check availability for vaccination


### Variables to set
- `YOUR_DISTRICT_ID` - district id you can get it from meta apis   
- `FROM_TODAY_DAYS_TO_CHECK` - how many days you wish to check from today, if you want to check for upcomming week (7 days) this value should be 7, if you want to check for today only then it will be 1.   
- `MESSAGE_AS_YOU_WANT` - you can write your formated message here. already given an example, you can use any of the key from sample payload in the message format.   
- `DISCORD_WEBHOOK_URL` - this is to get notification in discord.   


***You can also update condition as you wish, you can use the same sample payload properties there as well.***


Sample Item payload
```json
{
  "center_id": 692858,
  "name": "MORBI ROAD COMMUNITY HALL - 2",
  "address": "NEAR JAKAT NAKA MORBI ROAD",
  "state_name": "Gujarat",
  "district_name": "Rajkot Corporation",
  "block_name": "East Zone",
  "pincode": 360003,
  "from": "09:00:00",
  "to": "13:00:00",
  "lat": 22,
  "long": 70,
  "fee_type": "Free",
  "session_id": "a6566d92-2a14-46f2-9cce-1c760cedb02a",
  "date": "22-05-2021",
  "available_capacity_dose1": 0,
  "available_capacity_dose2": 0,
  "available_capacity": 0,
  "fee": "0",
  "min_age_limit": 18,
  "vaccine": "COVISHIELD",
  "slots": [
    "09:00AM-10:00AM",
    "10:00AM-11:00AM",
    "11:00AM-12:00PM",
    "12:00PM-01:00PM"
  ]
}
```

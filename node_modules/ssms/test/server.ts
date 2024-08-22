import { sendSingleMessage } from "ssms";
const API_KEY = "5476b38fff208e0f77c358fad84078b179670ecf";

async function start() {
  await sendSingleMessage(API_KEY, "7777777", "Test message", 1);
}

start();

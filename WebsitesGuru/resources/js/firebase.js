import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { createUserWithEmailAndPassword } from "firebase/auth";
import {getAuth} from "firebase/auth";
import { getStorage } from "firebase/storage";


const firebaseConfig = {
  apiKey: Process.env.REACT_APP_FIREBASE_KEY,
  authDomain: "layoutregisterlogin.firebaseapp.com",
  databaseURL: "https://layoutregisterlogin-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "layoutregisterlogin",
  storageBucket: "layoutregisterlogin.appspot.com",
  messagingSenderId: "677074011722",
  appId: "1:677074011722:web:2099d3598d2b6002bec8b3",
  measurementId: "G-DC70HJS0NX"
};


const app = initializeApp(firebaseConfig);
export const auth = getAuth()
const analytics = getAnalytics(app);
export const storage = getStorage(app);

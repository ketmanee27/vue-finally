// Import the functions you need from the SDKs you need
import { initializeApp } from 'firebase/app'
import { getFirestore } from 'firebase/firestore'
import { getAuth } from 'firebase/auth'

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: 'AIzaSyCg5PK2YsOmc2wHccaB8vJLalH2lA7UnR0',
  authDomain: 'project-1d377.firebaseapp.com',
  projectId: 'project-1d377',
  storageBucket: 'project-1d377.appspot.com',
  messagingSenderId: '1013723978713',
  appId: '1:1013723978713:web:095e02b54b441fa5cb97c8'
}

// Initialize Firebase
const app = initializeApp(firebaseConfig)
export const db = getFirestore(app)
export const auth = getAuth(app)

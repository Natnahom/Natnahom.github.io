import app from "./server.js"
import mongodb from "mongodb"
//import ReviewsDAO from "./dao/reviewsDAO.js"

putenv("Mongo_username = natnahom");
putenv("Mongo_password = 122112n@t");


const MongoClient = mongodb.MongoClient
const mongo_username = process.env['Mongo_username']
const mongo_password = process.env['Mongo_password']

const uri = `mongodb+srv://${mongo_username}:${mongo_password}@cluster0.chbxfoh.mongodb.net/?retryWrites=true&w=majority`

const port = 8000

MongoClient.connect(
    uri,
    {
        maxPoolSize: 50,
        wtimeoutMS: 2500,
        useNewUrlParser: true
    })
    .catch(err => {
        console.error(err.stack)
        process.exit(1)
    })
    .then(async client => {
        app.listen(port, () => {
            console.log(`listening on port ${port}`)
        })
    })
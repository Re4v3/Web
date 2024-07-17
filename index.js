const express = require('express');
const app = express();
const pool = require('./connect');

// Middleware สำหรับ parse JSON
app.use(express.json());

// Route example
app.get('/', (req, res) => {
    res.send('LOVEPOTION\nเกี่ยวกับ\nคำถามที่พบบ่อย\nเข้าสู่ระบบ');
});

// ตัวอย่างการเชื่อมต่อกับฐานข้อมูล
app.get('/test-db', async (req, res) => {
    try {
        const client = await pool.connect();
        const result = await client.query('SELECT NOW()');
        client.release();
        res.send(result.rows);
    } catch (err) {
        console.error(err);
        res.status(500).send('Database connection error');
    }
});

const PORT = process.env.PORT || 10000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});

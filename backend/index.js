import express from "express";
import cors from "cors";
import dotenv from "dotenv";

dotenv.config();

const app = express();

app.use(
  cors({
    origin: "http://localhost:5173", // <-- Updated to match your frontend port
    methods: ["GET", "POST"],
    allowedHeaders: ["Content-Type"],
  })
);

app.use(express.json());

const OPENROUTER_API_KEY =
  process.env.OPENROUTER_API_KEY || "your_openrouter_api_key_here"; // set in .env or here directly

app.post("/api/ask", async (req, res) => {
  try {
    const { prompt } = req.body;
    if (!prompt) {
      return res.status(400).json({ error: "Prompt is required" });
    }

    const routerRes = await fetch(
      "https://openrouter.ai/api/v1/chat/completions",
      {
        method: "POST",
        headers: {
          Authorization: `Bearer ${OPENROUTER_API_KEY}`,
          "Content-Type": "application/json",
          "HTTP-Referer": "http://localhost:5173", // Optional, updated to frontend origin
          "X-Title": "GymRatAI", // Optional
        },
        body: JSON.stringify({
          model: "deepseek/deepseek-r1-0528-qwen3-8b:free",
          messages: [{ role: "user", content: prompt }],
        }),
      }
    );

    if (!routerRes.ok) {
      const errorData = await routerRes.json();
      return res.status(500).json({
        error: errorData.error?.message || "Failed to fetch from OpenRouter",
        details: errorData,
      });
    }

    const data = await routerRes.json();
    res.json({
      response:
        data.choices[0]?.message?.content || "No response from OpenRouter",
    });
  } catch (error) {
    console.error("OpenRouter error:", error);
    res.status(500).json({
      error: error.message || "Internal server error",
    });
  }
});

const PORT = process.env.PORT || 8080;
app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});

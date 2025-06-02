import { useState } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import logo from "./../public/gymRatAI-logo.svg";
import ReactMarkdown from "react-markdown";

function App() {
  const [message, setMessage] = useState("");
  const [response, setResponse] = useState("");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError("");
    try {
      const res = await fetch("http://localhost:8080/api/ask", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ prompt: message }),
      });

      if (!res.ok) {
        const errorData = await res.json();
        throw new Error(errorData.error || "Request failed");
      }

      const data = await res.json();
      setResponse(data.response);
    } catch (error) {
      setError(error.message);
      console.error("API Error:", error);
    }
    setLoading(false);
  };

  return (
    <div
      className="min-vh-100 w-100 d-flex justify-content-center align-items-center bg-dark text-light"
      style={{ padding: "2rem", minWidth: "100vw" }}
    >
      <div
        className="w-100"
        style={{
          maxWidth: "700px",
        }}
      >
        {/* Logo and Title */}
        <div className="text-center mb-4">
          <img src={logo} alt="GymRatAI Logo" style={{ width: "150px" }} />
          <h1 className="text-danger fw-bold mt-3">GymRatAI 💪</h1>
        </div>

        {/* Form */}
        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label htmlFor="message" className="form-label">
              Ask something:
            </label>
            <input
              type="text"
              id="message"
              className="form-control bg-secondary text-light border-danger"
              value={message}
              onChange={(e) => setMessage(e.target.value)}
              placeholder="e.g., Give me a workout for arms"
              required
            />
          </div>
          <button
            type="submit"
            className="btn btn-danger w-100"
            disabled={loading}
          >
            {loading ? "Asking AI..." : "Ask GymRatAI"}
          </button>
        </form>

        {/* Error */}
        {error && (
          <div className="mt-4 alert alert-danger">
            <h5>Error:</h5>
            <p>{error}</p>
          </div>
        )}

        {/* Response */}
        {response && (
          <div
            className="mt-4 bg-secondary text-light rounded p-3"
            style={{
              maxHeight: "400px",
              overflowY: "auto",
              border: "2px solid #dc3545",
            }}
          >
            <h5 className="text-danger">Response:</h5>
            <ReactMarkdown
              children={response}
              components={{
                h1: ({ node, ...props }) => (
                  <h3 style={{ color: "#dc3545" }} {...props} />
                ),
                h2: ({ node, ...props }) => (
                  <h4 style={{ color: "#dc3545" }} {...props} />
                ),
                ul: ({ node, ...props }) => (
                  <ul style={{ paddingLeft: "1.2rem" }} {...props} />
                ),
                li: ({ node, ...props }) => (
                  <li style={{ marginBottom: "0.3rem" }} {...props} />
                ),
                // customize more as you want
              }}
            />
          </div>
        )}
      </div>
    </div>
  );
}

export default App;

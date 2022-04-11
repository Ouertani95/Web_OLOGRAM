import dash
import dash_bootstrap_components as dbc

app = dash.Dash(
    external_stylesheets=[dbc.themes.BOOTSTRAP]
)

app.layout = dbc.Alert(
    "Hello, Bootstrap!", className="m-5"
)
app.layout = dbc.Button(
    [
        "Notifications",
        dbc.Badge("4", color="light", text_color="primary", className="ms-1"),
    ],
    color="primary",
)

if __name__ == "__main__":
    app.run_server()
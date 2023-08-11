const signatures = {
    'JVBERi0': "application/pdf",
    'R0lGODdh': "image/gif",
    'R0lGODlh': "image/gif",
    'iVBORw0KGgo': "image/png",
    "/9j/": "image/jpg"
};

export default function detectMimeType(b64) {
    for (const s in signatures) {
        if (b64.indexOf(s) === 0) {
            return signatures[s];
        }
    }
}
#!/bin/bash

# Directory where your .po files are stored
LANG_DIR="languages"

# Check if msgfmt is available
if ! command -v msgfmt &> /dev/null; then
    echo "Error: msgfmt (gettext) is not installed."
    exit 1
fi

# Compile all .po files in the language directory
echo "Compiling .po files in $LANG_DIR..."

for po_file in "$LANG_DIR"/*.po; do
    [ -e "$po_file" ] || continue  # Skip if no .po files
    mo_file="${po_file%.po}.mo"
    echo "→ $po_file → $mo_file"
    msgfmt "$po_file" -o "$mo_file"
done

echo "✅ Done."

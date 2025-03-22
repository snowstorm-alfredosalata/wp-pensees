#!/bin/bash

POT_FILE="languages/pensees.pot"

if [ ! -f "$POT_FILE" ]; then
    echo "❌ Missing POT file: $POT_FILE"
    exit 1
fi

echo "→ Merging POT updates into existing .po files..."

for po_file in languages/*.po; do
    [ -e "$po_file" ] || continue
    echo "→ Updating $po_file"
    msgmerge --update --backup=off "$po_file" "$POT_FILE"
done

echo "✅ All .po files updated."

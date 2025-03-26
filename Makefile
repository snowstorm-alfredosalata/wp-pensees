# Plugin meta
PLUGIN_NAME := pensees
VERSION := 1.1

MAKEFILE_DIR := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
BUILD_DIR := $(MAKEFILE_DIR)build
LANG_DIR := $(MAKEFILE_DIR)languages
SCRIPTS_DIR := $(MAKEFILE_DIR)scripts

# Default task
all: clean pot update-po mo zip

# Generate .pot file from PHP source
pot:
	@echo "→ Generating POT file..."
	@wp i18n make-pot . $(LANG_DIR)/$(PLUGIN_NAME).pot

# Compile all .po files into .mo using the custom script
mo:
	@echo "→ Compiling translations (.po → .mo)..."
	@bash $(SCRIPTS_DIR)/compile-translations.sh

update-po:
	@bash $(SCRIPTS_DIR)/update-po.sh

# Build a clean ZIP archive for release
zip:
	@echo "→ Creating plugin ZIP archive..."
	@rm -rf $(BUILD_DIR) $(PLUGIN_NAME)-$(VERSION).zip
	@mkdir -p $(BUILD_DIR)/$(PLUGIN_NAME)
	@rsync -a --exclude=$(BUILD_DIR) \
		--exclude=.git \
		--exclude='*.zip' \
		--exclude='*.pot~' \
		--exclude='*.md' \
		--exclude='*.sh' \
		--exclude='*.DS_Store' \
		. $(BUILD_DIR)/$(PLUGIN_NAME)/
	@cd $(BUILD_DIR) && zip -rq ./$(PLUGIN_NAME)-$(VERSION).zip $(PLUGIN_NAME)
	@rm -rf $(BUILD_DIR)/pensees
	@echo "✅ Built $(PLUGIN_NAME)-$(VERSION).zip"

# Clean build artifacts
clean:
	@echo "→ Cleaning..."
	@rm -rf $(BUILD_DIR) $(PLUGIN_NAME)-*.zip

.PHONY: all pot update-po mo zip clean

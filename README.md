# Digital Signature For Contact Form 7

**Author:** Design Revolutions  
**Website:** https://www.designrevolutions.com  
**Version:** 1.0  
**License:** GPLv2 or later  
**Requires:** WordPress 5.0+, PHP 5.6+, Contact Form 7

---

## Overview

Adds a handwritten digital signature field to any Contact Form 7 form. Visitors sign using a mouse or touchscreen. The signature is captured as a PNG image and can be included in the email notification as an inline image or attachment.

Multiple signature fields per form are fully supported.

---

## Features

- Unlimited signature pads per form
- Configurable pen colour and background colour per field
- Configurable pad width and height per field
- Mark signature fields as required
- Add custom CSS class and ID to each pad
- Signature automatically clears after successful form submission
- Signature can be sent as an email attachment or embedded inline

---

## Requirements

- WordPress 5.0 or higher
- PHP 5.6 or higher
- [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) installed and active

The plugin will deactivate itself automatically if Contact Form 7 is not present.

---

## Installation

### Option A — Upload via WordPress admin (recommended)

1. Zip the `dr-digital-signature-cf7` folder:
   - On Windows: right-click the folder → **Send to** → **Compressed (zipped) folder**
   - On Mac: right-click → **Compress**
2. In your WordPress admin, go to **Plugins → Add New → Upload Plugin**
3. Choose the zip file and click **Install Now**
4. Click **Activate Plugin**

### Option B — Manual FTP/SFTP upload

1. Upload the `dr-digital-signature-cf7` folder (unzipped) to `/wp-content/plugins/`
2. In your WordPress admin, go to **Plugins** and activate **Digital Signature For Contact Form 7**

---

## Usage

### Adding a signature field to a form

1. Go to **Contact → [your form] → Form**
2. Click the **digital_signature** button in the tag generator toolbar
3. Configure the options:
   | Option | Description | Default |
   |--------|-------------|---------|
   | Name | Field name (used in mail tags) | — |
   | Pen Color | Colour of the drawn signature | `#000000` |
   | Background Color | Canvas background colour | `#dddddd` |
   | Width (px) | Canvas width in pixels | `300` |
   | Height (px) | Canvas height in pixels | `200` |
   | Required | Whether the field must be filled | unchecked |
   | Id / Class | Custom HTML attributes | — |
4. Click **Insert Tag** — the tag is inserted into the form body

### Tag format

```
[signature field-name color:#000000 backcolor:#dddddd width:300 height:200]
```

For a required field:

```
[signature* field-name color:#000000 backcolor:#dddddd width:400 height:250]
```

### Including the signature in the email

In the **Mail** tab of your CF7 form, insert the mail tag generated for your field (e.g. `[field-name]`). This will include the URL of the saved signature image in the email body.

To send the signature as an **email attachment**, add the `attachment` option to the tag:

```
[signature* field-name attachment color:#000000 backcolor:#dddddd]
```

---

## Support

For support enquiries, contact Design Revolutions at:  
https://www.designrevolutions.com/support/

---

## Changelog

### 1.0
- Initial release
- Unlimited signature pads per form
- Configurable width, height, pen colour, and background colour
- Developed by Design Revolutions

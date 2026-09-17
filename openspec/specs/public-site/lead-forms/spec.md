# public-site/lead-forms Specification

## Purpose
Makes the two lead-capturing forms on the public site (contact form, footer newsletter subscribe) predictable: a visitor never loses what they typed, always sees why a submission failed, and always sees that a submission succeeded.

## Requirements

### Requirement: Contact form preserves input on validation failure
When a contact form submission fails validation, the re-rendered form MUST contain the previously submitted values for first name, last name, phone, e-mail and message.

#### Scenario: Invalid e-mail with other fields filled
- **WHEN** a visitor submits the contact form with a valid first name, last name, phone, message and the e-mail `not-an-email`
- **THEN** the response re-renders the form with the first name, last name, phone and message fields pre-filled with the submitted values

### Requirement: Each contact form field shows its own error
Every validated contact form field MUST display its own validation message next to that field, independent of the state of other fields. The error message MUST be associated with the input it describes.

#### Scenario: Only the e-mail is invalid
- **WHEN** a visitor submits the contact form where only the e-mail is invalid
- **THEN** the e-mail field is marked as erroneous and shows the e-mail validation message, and no other field shows an error

#### Scenario: Error label targets its field
- **WHEN** any contact field is rendered in the error state
- **THEN** the error label's `for` attribute equals the `id` of that field's input

### Requirement: Contact form confirms success in the visitor's locale
After a successful submission the visitor MUST see a confirmation message in the resolved locale, and the form fields MUST be empty.

#### Scenario: Successful submission on the Ukrainian site
- **WHEN** a visitor on `/uk/contact-us` submits a valid contact form (reCAPTCHA passing in the test environment)
- **THEN** the response shows a Ukrainian confirmation message and empty form fields

### Requirement: Contact form inputs declare their purpose
Contact form inputs MUST carry semantic attributes that let browsers and assistive technology fill and announce them: `required` on mandatory fields, `autocomplete` tokens (`given-name`, `family-name`, `tel`, `email`), and `type="tel"` for the phone input.

#### Scenario: Phone input
- **WHEN** the contact form is rendered
- **THEN** the phone input has `type="tel"` and `autocomplete="tel"`, and the e-mail input has `autocomplete="email"`

### Requirement: Subscribe form gives visible feedback
The footer subscribe form MUST show a visible success message after a successful subscription and a visible validation message when the e-mail is missing, invalid or already subscribed. The submission mechanism (full page or in-page) MUST match the server response contract so the feedback is actually displayed.

#### Scenario: Valid subscription
- **WHEN** a visitor submits a new valid e-mail in the footer subscribe form
- **THEN** the page shows a success confirmation near the form in the resolved locale

#### Scenario: Invalid e-mail
- **WHEN** a visitor submits `nope` in the footer subscribe form
- **THEN** the page shows the e-mail validation message near the form and the entered value is preserved

### Requirement: Form labels and messages are localized
All contact and subscribe form labels, button captions, headings, and success/error messages authored by the site MUST come from the locale dictionaries and render in the resolved locale.

#### Scenario: Polish contact page
- **WHEN** a visitor loads `/pl/contact-us`
- **THEN** the form heading, field labels and submit button caption are Polish, and no English dictionary key text is visible

# Available validators

*   `NotEmpty` - Error when string is empty.
*   `Email` - Error when string does not contain a valid email address.
*   `Slug` - Error when string is not a valid slug.
*   `SlugUnique` - Error when string has already been used as a slug.
*   `MaxLength` - Error when string is longer than specified in `maxLength`.
*   `FileType` - Error when an uploaded file does not have a filetype as listed in `file.types.*`.
*   `FileSize` - Error when an uploaded file is bigger than the MB specified in `file.maxSize`.

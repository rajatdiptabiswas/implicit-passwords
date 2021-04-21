# Implicit Passwords Using Autobiographical Memory Recall

Analyzed the feasibility of shifting towards an authentication system based on autobiographical memory that would alleviate the need to remember alphanumeric text passwords.

*This project was made for the **CS-1791 Project** course at **MNNIT Allahabad***.

Most passwords used today require users to remember long and complicated sequences of alphanumeric characters which the human brain was not made to remember efficiently.

Humans can only remember and recall 5 alphanumeric passwords on average. This is due to the cognitive phenomenon called "interference of memory", not due to ignorance.

However, autobiographical memories hold emotions and are hence easier to remember for human beings. Tapping into people’s autobiographical or emotional memories can help create passwords that are more secure as well as easier to remember.

Read more about implicit passwords [here](https://www.sciencedirect.com/science/article/pii/S0895717712001719) and [here](https://www.ijser.org/researchpaper/Implicit-Password-Authentication-System.pdf).

## Idea

Implicit information is extracted from questions answered by the user during the registration process.
The user is encouraged to provide answers from anecdotes that are autobiographical in nature so that it is easier to recall for the user.

The implicit information extracted from the anecdotes is used to serve questions that have multiple answer spaces.
Only the user who was present during the registration will be able to infer the references that are implied in the questions asked.

The questions are randomly generated and the answer choices can change as well.
However, the implicit information implied in the answer choices remains the same.
The same question can be asked in multiple ways, e.g. markers on a map, images, video frames, etc.

No questions are asked explicitly. The user will be able to infer what is being asked from the answer choices themselves.

The proposed idea is theoretically free from shoulder-surfing, key-logging, social engineering, guessing vulnerability, and dictionary attacks.

More information can be found in the [project presentation](https://github.com/armag-pro/implicit-passwords/blob/master/presentation.pdf).

## Implementation

This project is an implementation of the proposed idea. 

The picture below shows an example login screen.

![Authenticate](https://github.com/armag-pro/implicit-passwords/blob/master/authentication.png "Authenticate")

### Instructions
This is a standard PHP + MySQL project.
1) Place the `web-dir` in your PHP root `htdocs` directory
2) Import the SQL dump `db_dump.sql`

## Authors
*University project group under the mentorship of **Prof. Suneeta Agarwal***
* **Tuhin Subhra Patra** - [armag-pro](https://github.com/armag-pro)
* **Rajat Dipta Biswas** - [rajatdiptabiswas](https://github.com/rajatdiptabiswas)
* **Upmanyu Jamwal**
* **S Pranav Ganesh**

See also the list of [contributors](https://github.com/armag-pro/implicit-passwords/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

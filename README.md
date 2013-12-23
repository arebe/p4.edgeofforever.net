p4.edgeofforever.net
====================

PROJECT 4 for DG40

This application is an elaboration on my P2 app
(p2.edgeofforever.net); it is a micro blog for sharing panoramic
photos. I had a few friends try out the P2 application and
incorporated both that feedback, and the feedback I received from my
DG40 grader. I created php and js validation for user-submitted
data, and sanitized incoming data to protect against injection
attacks. I also modified the flow of the UI, to make it more
understandable to new users of the site. I also added "stalking"
functionality, so users can see each others info.

The second part of my upgrade was a js application for viewing the
panoramic photos. I wanted to create an intuitive UI for zooming,
panning, and orbiting perspective. Well, I managed 2/3 ;) 

Note that as of this message, the resolution of the photos in Firefox
seems really poor, and distorts while panning. I'm attempting to
troubleshoot that issue. It looks great in Chrome.

Features:
  improvements from p2 comments:
[X]comment feature is buried - make more obvious
[X]validation errors (js)
[X]force unique sign up name, non-blank (php)
[X]do not allow empty posts / comments (php)
[X]html5 validator - fix tags http://validator.w3.org/

  improvements to security:
[X] check that each post is sanitized (php / mySQL)
[X] validate names, email addresses & passwords  js)
[X]validate log in in php - check for blanks & dups

  improvements re: suggestions:
[X]fix font faces
[X]change nav roll over
[X]users auto-follow selves
[X]after user submits a post -> take to post page
[X]resize input boxes
[X]see profiles of other users, and list of recent posts
[X]different home page - direct to panostream
[X]move log out link
[X]delete "home" link
[X]edit profile - name
[X]msg about "log in to comment"
[X]msg about "follow users to see photos in stream"

  panovision view post app:
[X]display image on canvas
[X]zoom interaction
[X]x and y pan interaction

Javascript:
main.js -- Javascript is handling input validation on the following pages: 
 - Sign up 
 - Add post

panovision.js -- Javascript is used to manipulate photos on an HTML5 canvas in the
individual posts view

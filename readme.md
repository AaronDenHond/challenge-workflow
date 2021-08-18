###BeCode back end consolidation challenge.
###Group project by Izidor and Aaron.

Title: workflow

    Repository: challenge-workflow
    Type of Challenge: Consolidation Challenge
    Duration: 5 days
    Deployment strategy : heroku
    Team challenge : group

Task : create a workflow with a ticketline.

##Plan of attack

1. ERD diagram to visualize the project.
2. Setting up the repo, boilerplate and Git rules on working together.
3. Database connection.
4. Authentication with a user entity first. make:user not make entity!
5. Current "functionality" right now :

- register form via /register route
- login
  make:user will import interface

6. Further refine UML and start making ticket entity.
7. added properties in ticket entity, as well as necessary relations to the user.
8. Made crud for the ticket entity, with the makerbundle make:crud command.
   Had an error upon surfing to /ticket, index loaded fine, but had an error upon trying to make a new
   ticket : "Object User could not be converted to string."
   Solution : \_\_ToString() function in the User class.

//guest : not-authenticated users, client, firstline, secondline, manager = 5 types of users.
guest (non-auth user) can only see register form/homepage?
guest no entity, we dont save em. Best to work with "to see this you need to be atleast client"

// Use Security.yaml in config to check auth via role!

// When making relations in entities, dont always say yes for getters and setters when we dont need.
For example we will never getComments() via user, always via ticket.

done : routing to right ticket pool, access for agents/admins and clients, making comment entitiy and showing it on the template.

TODO : add table header for comments etc.

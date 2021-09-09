# BeCode back end consolidation challenge.

# Group project by Izidor and Aaron.

Title: workflow

    Repository: challenge-workflow
    Type of Challenge: Consolidation Challenge
    Duration: 5 days
    Deployment strategy : heroku
    Team challenge : group

Task : create a workflow with a ticketline.

## Plan of attack

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

guest : not-authenticated users, client, firstline, secondline, manager = 5 types of users.
guest (non-auth user) can only see register form/homepage?
guest no entity, we dont save em. Best to work with "to see this you need to be atleast client"

Use Security.yaml in config to check auth via role!

When making relations in entities, dont always say yes for getters and setters when we dont need.
For example we will never getComments() via user, always via ticket.

done : routing to right ticket pool, access for agents/admins and clients, making comment entitiy and showing it on the template.

TODO : add table header for comments etc.

### Current Functionality :

- Guest can register and become Users. Default role is ROLE_USER, which clients have.

- Hierarchical role system : Agents and Managers will also have ROLE_USER.

- Authentication : for registering and logging in.

- Rerouting for most links/buttons in place.

- Rerouting on log in depending on role.

- Ticket CRUD for agents and managers.

- User CRUD for managers.

- Access Control depending on roles.

- Routes :
  CLIENTS : / (homepage), /logissue (new ticket for clients), /mytickets (ticket by clientID)
  AGENTS : / (homepage), tickets (overall ticket pool for agents, agent tickets and client tickets) /ticket/new (new ticket by agent)
  MANAGER : same as agent, with /user (user crud for managers only)

## _Important :_

- Name relation to user not userID, mysql will it as user_id_id and namings make functions awkward to use.
- NAME A RELATION TO THE ENTITY NAME, NOT THE PROPERTY.
- Entity is Model in MVC AND Repositories are also Model, C is Controller, Form and Templates are View.
- WE NEED RELATIONAL PROPERTIES IN BOTH ENTITIES FOR ORM.
- PROPERTIES ARE NOT ALWAYS DISPLAYED IN DATABASE BUT USEFUL FOR ORM.
  if eg you do agent.userId in template, you actually call the whole user object,because userId is the FK in agent. so if u want id : do agent.userId.id

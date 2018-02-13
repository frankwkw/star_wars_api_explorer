/**
 * PersonList component
 * Created by frankwong on 12/02/2018.
 */
import React, { Component } from 'react'
import { graphql } from 'react-apollo'
import gql from 'graphql-tag'
import List from 'material-ui/List';
import { CircularProgress } from 'material-ui/Progress';
import PersonListRecord from './PersonListRecord'

class PersonList extends Component {
    render() {
        // Loading data
        if (this.props.peopleQuery && this.props.peopleQuery.loading) {
            return <CircularProgress size={50} color="secondary" style={{padding: 20}} />
        }

        // Failed request
        if (this.props.peopleQuery && this.props.peopleQuery.error) {
            return <div>Error</div>
        }

        // Successful request
        const peopleToRender = this.props.peopleQuery.allPeople

        return (
            <List>
                {peopleToRender.map(person => <PersonListRecord key={person.id} person={person} onSelectResource={this.props.onSelectResource} />)}
            </List>
        )
    }
}

// SWAPI People query
const PEOPLE_QUERY = gql`
    query PeopleQuery {
        allPeople {
            id
            name
        }
    }
`

// Wrap person list component with People query
export default graphql(PEOPLE_QUERY, { name: 'peopleQuery' }) (PersonList)
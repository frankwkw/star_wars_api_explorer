/**
 * Created by frankwong on 12/02/2018.
 */
import React, { Component } from 'react'
import { graphql } from 'react-apollo'
import gql from 'graphql-tag'
import { ListItem, ListItemText } from 'material-ui/List';
import { LinearProgress } from 'material-ui/Progress';
import Icon from 'material-ui/Icon';
import MovieIcon from 'material-ui-icons/Movie';

class PersonDetailFilmList extends Component {
    render() {
        // Loading data
        if (this.props.personFilmsQuery && this.props.personFilmsQuery.loading) {
            return <LinearProgress color="secondary" />
        }

        // Failed request
        if (this.props.personFilmsQuery && this.props.personFilmsQuery.error) {
            return <div>Error</div>
        }

        // Successful request
        const personToRender = this.props.personFilmsQuery.person

        return (
            <div>
                {personToRender.films.map(film => (
                    <ListItem key={film.id} button>
                        <Icon>
                            <MovieIcon />
                        </Icon>
                        <ListItemText primary={film.title} />
                    </ListItem>
                ))}
            </div>
        )
    }
}

// SWAPI Person query
const PERSONFILMS_QUERY = gql`
    query personFilmsQuery($id: Int) {
        person(id: $id) {
            films {
                id
                title
                release_date
            }
        }
    }
`

// Wrap person list component with People query
export default graphql(PERSONFILMS_QUERY, {
    name: 'personFilmsQuery',
    options: ownProps => {
        const id = +ownProps.personId.match(/\d+/)
        return {
            variables: { id }
        }
    },
}) (PersonDetailFilmList)
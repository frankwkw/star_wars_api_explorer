/**
 * Created by frankwong on 12/02/2018.
 */
import React, { Component } from 'react'
import { graphql } from 'react-apollo'
import gql from 'graphql-tag'
import Typography from 'material-ui/Typography';
import { CircularProgress } from 'material-ui/Progress';
import List from 'material-ui/List';
import { ListItem, ListItemText } from 'material-ui/List';
import Divider from 'material-ui/Divider';
import Icon from 'material-ui/Icon';
import ListSubheader from 'material-ui/List/ListSubheader';
import PublicIcon from 'material-ui-icons/Public';
import PersonDetailFilmList from './PersonDetailFilmList'

class PersonDetail extends Component {
    render() {
        // Loading data
        if (this.props.personQuery && this.props.personQuery.loading) {
            return <CircularProgress size={50} color="secondary" style={{padding: 20}} />
        }

        // Failed request
        if (this.props.personQuery && this.props.personQuery.error) {
            return <div>Error</div>
        }

        // Successful request
        const personToRender = this.props.personQuery.person

        return (
            <div>
                <Typography variant="title" component="h1">
                    {personToRender.name}
                </Typography>
                <List>
                    <ListItem>
                        <ListItemText primary="Gender" secondary={personToRender.gender} />
                    </ListItem>
                    <ListItem>
                        <ListItemText primary="Born" secondary={personToRender.birth_year} />
                    </ListItem>
                    <ListItem>
                        <ListItemText primary="Height" secondary={personToRender.height} />
                    </ListItem>
                    <ListItem>
                        <ListItemText primary="Hair" secondary={personToRender.hair_color} />
                    </ListItem>
                    <ListItem>
                        <ListItemText primary="Eyes" secondary={personToRender.hair_color} />
                    </ListItem>
                    <Divider />
                    <List
                        component="nav"
                        subheader={<ListSubheader component="div">Homeworld</ListSubheader>}
                    >
                        <ListItem button>
                            <Icon>
                                <PublicIcon />
                            </Icon>
                            <ListItemText primary={personToRender.homeworld.name} />
                        </ListItem>
                    </List>
                    <Divider />
                    <List
                        component="nav"
                        subheader={<ListSubheader component="div">Films</ListSubheader>}
                    >
                        <PersonDetailFilmList personId={this.props.personId} />
                    </List>
                </List>
            </div>
        )
    }
}

// SWAPI Person query
const PERSON_QUERY = gql`
    query PersonQuery($id: Int) {
        person(id: $id) {
            name
            gender
            birth_year
            height
            hair_color
            eye_color
            homeworld {
                name
            }
        }
    }
`

// Wrap person list component with People query
export default graphql(PERSON_QUERY, {
    name: 'personQuery',
    options: ownProps => {
        const id = +ownProps.personId.match(/\d+/)
        return {
            variables: { id }
        }
    },
}) (PersonDetail)
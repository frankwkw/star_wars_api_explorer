/**
 * PersonListRecord component
 * Created by frankwong on 12/02/2018.
 */
import React, { Component } from 'react'
import { ListItem, ListItemText } from 'material-ui/List';
import Icon from 'material-ui/Icon';
import PersonIcon from 'material-ui-icons/Person';

class PersonListRecord extends Component {
    render() {
        return (
            <ListItem
                button
                variant="raised"
                component="button"
                onClick={() => {this.props.onSelectResource('people', this.props.person.id)}}
            >
                <Icon>
                    <PersonIcon />
                </Icon>
                <ListItemText primary={this.props.person.name} />
            </ListItem>
        )
    }
}

export default PersonListRecord
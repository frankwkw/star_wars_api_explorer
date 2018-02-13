/**
 * Created by frankwong on 12/02/2018.
 */
import React, { Component } from 'react'
import { withStyles } from 'material-ui/styles';
import Paper from 'material-ui/Paper';
import Grid from 'material-ui/Grid';
import AppBar from 'material-ui/AppBar';
import Tabs, { Tab } from 'material-ui/Tabs';
import PersonList from './PersonList'
import PersonDetail from './PersonDetail'

const styles = theme => ({
    paper: {
        textAlign: 'center',
        width: 450
    }
});

class Explorer extends Component {
    onSelectResource(type, id) {
        this.props.history.push(`/${type}/${id}`)
    }

    render() {
        const { classes } = this.props;

        return (
            <Grid container justify="center" spacing={16}>
                <Grid item>
                    <Paper square={true} className={classes.paper} style={{textAlign: 'center'}}>
                        <AppBar position="static" color="default" elevation={0}>
                            <Tabs value={0}>
                                <Tab label="People" />
                            </Tabs>
                        </AppBar>
                        <PersonList onSelectResource={this.onSelectResource.bind(this)} />
                    </Paper>
                </Grid>
                <Grid item>
                    <Paper square={true} className={classes.paper}>
                        <PersonDetail personId={this.props.match.params.entityId} />
                    </Paper>
                </Grid>
            </Grid>
        )
    }
}
export default withStyles(styles)(Explorer);
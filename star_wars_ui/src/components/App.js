/**
 * Application component
 * Created by frankwong on 11/02/2018.
 */
import React, { Component } from 'react';
import { Switch, Route, Redirect } from 'react-router-dom'
import { withRouter } from 'react-router'
import Typography from 'material-ui/Typography';
import { withStyles } from 'material-ui/styles';
import Explorer from './Explorer'

const styles = theme => ({
    root: {
        flexGrow: 1,
        margin: 30,
    },
    title: {
        textAlign: 'center',
        perspective: 700,
        marginBottom: 20,
    },
    titleIcon: {
        fill: theme.palette.secondary.main
    },
    titleText: {
        color: theme.palette.text.primary,
        transform: 'rotateX(35deg)',
    }
});

class App extends Component {
    render() {
        const { classes } = this.props;

        return (
            <div className={classes.root}>
                <div className={classes.title}>
                    <svg className={classes.titleIcon} baseProfile="tiny" height="96px" id="Layer_1" version="1.2" viewBox="0 0 512 512" width="96px">
                        <path d="M505.122,245.073c-0.55-15.348-2.304-30.38-5.473-44.904H397.809v-17.961h35.923v-17.961h-71.846v-17.962h53.885v-17.961  h-17.962v-17.961h-35.923V92.399h17.962V74.438h-35.924V56.477h17.962V38.515V27.114C329.189,11.561,292.74,2.592,254.116,2.592  C118.264,2.592,7.87,110.385,3.104,245.073H505.122z M164.309,56.477c39.671,0,71.846,32.175,71.846,71.846  c0,39.683-32.175,71.846-71.846,71.846c-39.689,0-71.847-32.164-71.847-71.846C92.462,88.652,124.62,56.477,164.309,56.477"/><path d="M308.001,487.554h-17.962v-17.961h53.885v-17.962h17.962v-17.962h53.885v-17.961h17.961v-17.962h-35.923v-17.961h-53.885  v-17.962h35.924v-17.962h71.846V325.9h-35.923v-17.962h83.879c3.169-14.523,4.923-29.55,5.473-44.904H3.104  c4.765,134.7,115.16,242.481,251.012,242.481c18.522,0,36.52-2.14,53.885-5.929V487.554z"/>
                    </svg>
                    <Typography variant="display3" component="h1" className={classes.titleText} onClick={this._goHome}>
                        Star Wars<br/>API Explorer
                    </Typography>
                </div>
                <Switch>
                    <Route exact path='/' render={() => <Redirect to='/people/1' />} />
                    <Route exact path='/:entityType/:entityId' component={Explorer} />
                </Switch>
            </div>
        )
    }
}

export default withStyles(styles)(withRouter(App));

# M1 API
[![Build Status](https://travis-ci.org/RushCode/m1-api.svg?branch=master)](https://travis-ci.org/RushCode/m1-api) [![Code Climate](https://codeclimate.com/github/RushCode/m1-api/badges/gpa.svg)](https://codeclimate.com/github/RushCode/m1-api) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/RushCode/m1-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/RushCode/m1-api/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/RushCode/m1-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/RushCode/m1-api/build-status/master)

### About this class

This is a PHP7 API implementation for [M1 Messenger](https://play.google.com/store/apps/details?id=smile.m1project)

## Installation

Add the following to your composer.json:

```json
{
  "require": {
    "leocata/m1-api": "~1.0"
  }
}
```

## General usage

### Send request to Server

```
$connect = new Api();
$connect->performApiRequest($method);
```

## Api methods

### Session

#### getSessions
#### createSession
#### updateSession
#### closeSession

### Message

#### getMessages
#### sendMessage
#### message
#### deleteMessage
#### messageDeleted
#### messageDelivered
#### delivery
#### messageTyped

### State

#### Set state

```
$state = new SetState();
$state->termid = 'Android 4.2.2';
$state->online();
```

### Contact

#### findContact
#### inviteContact
#### contactRequested
#### contactAccept
#### contactAccepted
#### contactReject
#### contactRejected
#### deleteContact
#### updateContact
#### getContacts

### UserInfo

#### getUserInfo
#### setUserInfo
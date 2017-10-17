# M1 API
[![Build Status](https://travis-ci.org/RushCode/m1-api.svg?branch=master)](https://travis-ci.org/RushCode/m1-api) [![Code Climate](https://codeclimate.com/github/RushCode/m1-api/badges/gpa.svg)](https://codeclimate.com/github/RushCode/m1-api) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/RushCode/m1-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/RushCode/m1-api/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/RushCode/m1-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/RushCode/m1-api/?branch=master)

### About this class

This is a PHP7 API implementation for [M1 Messenger](https://play.google.com/store/apps/details?id=smile.m1project)

## Installation

Add the following to your composer.json:

```json
{
  "require": {
    "leocata/m1-api": "^1.0"
  }
}
```

## General usage

### Send request to Server

```
$connect = new Api();
$connect->sendRequest($method);
```

## Api methods

### Session

- [x] getSessions
- [x] getSessionList
- [ ] createSession
- [ ] updateSession
- [ ] closeSession

### Message

- [x] getMessages
- [x] sendMessage
- [x] message
- [ ] deleteMessage
- [x] messageDeleted
- [x] messageDelivered
- [x] delivery
- [x] messageTyped

### State

- [x] Set state

```
$state = new \leocata\M1\Methods\Request\SetState();
$state->online();
(new Api())->sendRequest($state);
```

### Contact

- [ ] findContact
- [ ] inviteContact
- [x] contactRequested
- [x] contactAccept
- [x] contactAccepted
- [ ] contactReject
- [ ] contactRejected
- [ ] deleteContact
- [ ] updateContact
- [x] getContacts

### UserInfo

- [x] getUserInfo
- [ ] setUserInfo

## Kunden Konto: mein Kochbox
<div class="mermaid">
sequenceDiagram
    IndexController ->> SubscriptionRepo: findVisisbleByCustomer(id)
    SubscriptionRepo --x IndexController: $subscriptions
    loop try-catch
        IndexController ->> IterationService: getPromotionIterationBySubscription($subscription);
        IterationService ->> SubscriptionIterationService: getNextIterationsBySubscription($subscription, $limit);
        SubscriptionIterationService ->> timesService: getNextTimesBySubscription($subscription, $limit)
        timesService ->> timesRepository: findUpcomingTimesBySubscription(firstDate, subscription, limit)
        timesRepository ->> timesService: times
        timesService ->> SubscriptionIterationService: $nextTimes
        IterationService --x IndexController: $promotionIteration
        SubcriptionIteration --x IndexController: $promotionIterationTimes
        SubcriptionIteration --x IndexController: $promotionIterationRecipes
        IndexController --x IndexController: push data to $subscriptionDataCollection
    end
    IndexController ->> IndexController: render view with view data

</div>


## Debitbook: import settlement
<div class="mermaid">
sequenceDiagram
    participant Session
    ImportController->>ImportController: check permission
    ImportController->>ImportController: create uploadForm
    ImportController->>uploadForm: get file data
    uploadForm--x ImportController: $filePath
    ImportController->>Importer: import($filePath)
    Importer->>EventSubscriber: dispatch PreImportEvent($filePath)
    EventSubscriber->>EventSubscriber: createImportArchive(event)
    Importer->>Reader: getReader()->read($filePath)
    Reader->>Reader: validate filepath
    loop try-catch
        Reader->>Reader: read single row from file
        Reader->>Reader: create a collection $result
        Reader->>Reader: create debitbook from rowData
        Reader->>EventSubscriber: dispatch ImportEvent($debitbook)
        EventSubscriber->>EventSubscriber: setInitUser($event)
        EventSubscriber->>EventSubscriber: validate($event)
        EventSubscriber-->Reader: $event & $debitbook
        Reader->>Reader: $result->addEntry($debitbook)
        Reader->>Reader: $result->addMessage($exception)
    end
    Reader--x Importer:  $result
    Importer->>EventSubscriber: dispatch PostImportEvent($result)
    EventSubscriber->>EventSubscriber: checkExistingReference($event)
    EventSubscriber-->Importer: $result
    loop try-catch
        Importer->>Importer: persist() & flush()
        Importer->>Importer: handle exception messages
    end
    note right of Importer: exception messages
    Importer--x ImportController: messages[ ]
    ImportController->>Session: save messages to session
    alt messages session existing
        ImportController->>Session: get messages from session
        Session-->>ImportController: messages
        ImportController->>Session: remove messages session
    else messages session not existing
        ImportController->>ImportController: NULL
    end
    ImportController->>Session: save messages to session
</div>

## Checklist: Release Master
<div class="mermaid">
sequenceDiagram
    chat->>chat: (1) `koza-dev` Code Freeze für Do. ansagen
    bitbucket->>bitbucket: (2) create release branch v3.5 from develop
    bitbucket--x jenkins: branch v3.5
    jenkins->>jenkins: start behat tests without tag `smoke`
    chat->>chat: Depoloyment auf QA1|QA2 für v3.5 ansagen
    note right of chat: koza-qa
    jenkins->>jenkins: v3.5 auf QA deployen
    chat->>chat: Ansage QA Deployment erfolgt
    note right of chat: koza-qa
    chat->>chat: Ansage Status von Testsuite
    note right of chat: koza-qa
    testserver->>testserver: QA test ausführen
    alt prüfen QA status
        jira->>jira: prüfen ob alle Tickets(v3.5) QA-Done sind
    else
        jira->>jira: Tag 3.5 setzen und Devs kontaktieren
    end
    bitbucket->>bitbucket: create PR from 'release' branch to 'master'
    bitbucket->>bitbucket: trigger the test build in PR
    backoffice->>backoffice: check the conflict with cutoff time
    chat->>chat: info 2x DEVs to approve the PR
    note right of chat: koza-devs
    chat->>chat: info 2x DEVs to approve the PR
    bitbucket->>bitbucket: if test build success, merge PR with 'merge --no-ff'
    bitbucket->>bitbucket: create relase TAG v3.5 from the last commit in 'master'
    note right of bitbucket: the merge commit
    jenkins->>jenkins: start & confirm the deploy
    chat->>chat: FYI deployment in progress
    chat->>chat: FYI deployment succeed
    note right of chat: koza-it
    graylog->>graylog: logging monitoring
    jira->>jira: set the status of tickets to 'Done
    bitbucket->>bitbucket: merge 'master' to 'develop' with 'merge --no-ff'
    chat->>chat: announce reintegration to develop DONE
    note right of chat: koza-dev

    
</div>
enkins Installation

Master agent

```
#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

echo "Updating package lists..."
sudo apt-get update

echo "☕ Installing OpenJDK 17..."
sudo apt install -y fontconfig openjdk-17-jre


echo "🔑 Adding Jenkins GPG key and repo..."
sudo mkdir -p /etc/apt/keyrings
sudo wget -O /etc/apt/keyrings/jenkins-keyring.asc https://pkg.jenkins.io/debian/jenkins.io-2023.key
echo "deb [signed-by=/etc/apt/keyrings/jenkins-keyring.asc] https://pkg.jenkins.io/debian binary/" | \
sudo tee /etc/apt/sources.list.d/jenkins.list > /dev/null

echo "🔄 Updating package list..."
sudo apt-get update -y

echo "🛠 Installing Jenkins..."
sudo apt-get install -y jenkins

echo "🚀 Starting Jenkins..."
sudo systemctl start jenkins
sudo systemctl enable jenkins

echo "🧱 Allowing traffic on port 8080..."
sudo ufw allow 8080/tcp || echo "UFW not active or already allowed"


# Get initial admin password
echo "🔐 Jenkins initial admin password:"
sudo cat /var/lib/jenkins/secrets/initialAdminPassword

echo "🌐 Access Jenkins at: http://<your-ec2-public-ip>:8080"
echo "🔑 Use the above password to unlock Jenkins UI"
echo "✅ After unlocking:"
echo "  - Install 'Suggested Plugins'"
echo "  - Create your admin user"
echo "  - Set Jenkins URL if prompted (you can set it in: Manage Jenkins > Configure System)"

echo "🧼 Done. Jenkins is installed and running."

echo "📌 Java version:"
java -version
```

on the agent

Install java

then on master

### 2. On Jenkins Master: Add SSH credential

On the Jenkins Web UI:

1. Dashboard → Manage Jenkins → Credentials → (Global or some domain) → Add Credentials.
  
2. Select **Kind**: *SSH Username with private key*.
  
  - Username: e.g. `jenkins` (or `ubuntu`, depending on your user)
    
  - Private Key: “Enter directly” → paste the contents of your `jenkins_agent_key` (private key)
    

Save this credential.

### 3. On Jenkins: Add the Node (Agent)

1. Jenkins UI → Manage Jenkins → Manage Nodes and Clouds → New Node
  
2. Give a name (e.g. `agent-1`), select *Permanent Agent*
  
3. Configure the node settings:
  
  - **Remote root directory**: directory on agent host where Jenkins workspace & builds will run. E.g. `/home/<username>
    
  - **Number of executors**: how many builds in parallel this agent can run
    
  - **Labels**: optional tag(s) you can use to restrict jobs to this agent, e.g. `linux ubuntu agent`
    
  - **Launch method**: *Launch agents via SSH*
    
    Then you configure:
    
    - **Host**: private or public IP or hostname of the agent (whichever is reachable by master)
      
    - **Credentials**: the SSH credential you've saved
      
    - **SSH Port**: by default `22`
      
    - **Host Key Verification Strategy**: e.g. *Manually trusted key verification strategy* (or another appropriate policy)
      
4. Save the node. Jenkins will try to connect via SSH, copy remote agent launcher (using remoting) and start the agent.
5. Then Create the PipeLine and add Github project 

<img width="1050" height="858" alt="image" src="https://github.com/user-attachments/assets/02deb832-cfbd-425a-90e7-8858b8f83d18" />

and use the Pipeline Script.

<img width="1388" height="637" alt="image" src="https://github.com/user-attachments/assets/9cf48529-2924-4907-b624-10c236428666" />



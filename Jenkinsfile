pipeline {
  agent any
  stages {
    stage('Git Checkout') {
      parallel {
        stage('checkout main') {
          steps {
            git(url: 'https://github.com/ThawThuHan/phonesithulwin_new_blog.git', branch: 'main', credentialsId: 'GitHub')
          }
        }

        stage('checkout dev') {
          steps {
            git(url: 'https://github.com/ThawThuHan/phonesithulwin_new_blog.git', branch: 'dev', credentialsId: 'GitHub')
          }
        }

      }
    }

    stage('check files') {
      steps {
        sh 'ls -la'
      }
    }

  }
}
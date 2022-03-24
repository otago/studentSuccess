###### SSO, ADFS, Saml set up for the OP website
 

**saml.yml**
To add addtional 'sites' to SSO add them in saml.yml under OP\samlsettings
```

somesite:
  entityId: "https://somesite.op.ac.nz/"
  privateKey: "../../certs/saml.pem"
  x509cert: "../../certs/saml.crt"
  logoutURL: "https://omesite.op.ac.nz/saml/sls"
  idpEndpoint: "devIdP"
    
```
**entityId** - name/id of site

**privateKey** - location of private key

**x509cert** - location of cert

**logoutURL**- Logout point


**idpEndpoint**<br>
2 options for this, 
- idp <br>
points to idp.op.ac.nz
- devIdP <br>
 points to dev.idp.ac.nz
 
 
 ###### Update IDP/adfs addresses 
 in saml.yml OP\samlsettings there are devidp and idp and looks something like
 ```
  devIdP:
    entityId: "https://devidp.op.ac.nz/adfs/services/trust"
    x509cert: "certs/devidp.pem"
    singleSignOnService: "https://devidp.op.ac.nz/adfs/ls/"
    singleLogoutService: "https://devidp.op.ac.nz/adfs/ls/"
 ````
 
 
 ###### Certs
 Certs are found in `/certs/` (in root)



###### saml.yml before my meddling
```
SilverStripe\SAML\Services\SAMLConfiguration:
    strict: false
    debug: true
    disable_authn_contexts: true
    nameIdEncrypted: false
    SP:
      entityId: "https://alastairn.op.ac.nz"
      privateKey: "certs/local.key"
      x509cert: "certs/local.cer"
      logoutURL: "https://ss4.alastair.n/saml/sls"
    IdP:
      entityId: "https://devidp.op.ac.nz/adfs/services/trust"
      x509cert: "certs/devidp.pem"
      singleSignOnService: "https://devidp.op.ac.nz/adfs/ls/"
      singleLogoutService: "https://devidp.op.ac.nz/adfs/ls/"````
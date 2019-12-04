#Событе newOffer

Событие newOffer генерируется при успешном добавлении "предложения" backend`ом в DB и отдаче статуса 200 ОК с телом модели offer

## Генерация события

```
    offerForm.vue;
    ...
     sendOfferDataOnRootEmit(responceData){
        this.$root.$emit('newOffer', responceData)
    }
```
> Этот метод вызывается из ```async sendForm()``` в позиции ```axiox.then()```  и передаёт ```responce.data```

Далее событие прилетает в $root компонент и оттуда уже компонент ``` waiting.vue ``` его ловит

```
    waiting.vue
    mounted() {
        ...          
        this.$root.$on('newOffer', data => {
            this.addNewOfferToOffersList(data);
        });
       ...          
    },
```
> Если waiting.vue поймал событие ```newOffer``` запускается метод ```addNewOfferToOffersList(data)``` который и укладывает данные ```responce.data``` в массив offers

```
addNewOfferToOffersList(param){
  this.offers.unshift(param);
},
```
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { DialogTemplateComponent } from './dialog.template.component';

describe('Dialog.TemplateComponent', () => {
  let component: Dialog.TemplateComponent;
  let fixture: ComponentFixture<DialogTemplateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DialogTemplateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DialogTemplateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

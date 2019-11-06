import {keepHtmlPipe} from './keep-html.pipe';

describe('EscapeHtmlPipe', () => {
  it('create an instance', () => {
    const pipe = new keepHtmlPipe();
    expect(pipe).toBeTruthy();
  });
});
